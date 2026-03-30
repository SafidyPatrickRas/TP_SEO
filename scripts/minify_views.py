#!/usr/bin/env python3
"""Minify HTML parts of PHP view files using php-minify.com when possible.

Default behavior:
- input: views/
- output: minified/
- minify only HTML segments (leave PHP intact)
- try remote minifier, fallback to local minify if remote is not usable
"""

from __future__ import annotations

import argparse
import re
import sys
import urllib.parse
import urllib.request
from pathlib import Path
from typing import Iterable, List, Tuple

DEFAULT_REMOTE_URL = "https://php-minify.com/html-minify/"


def http_get(url: str) -> str:
    with urllib.request.urlopen(url, timeout=20) as response:
        return response.read().decode("utf-8", errors="replace")


def http_post(url: str, data: dict) -> str:
    payload = urllib.parse.urlencode(data).encode("utf-8")
    req = urllib.request.Request(url, data=payload, method="POST")
    req.add_header("Content-Type", "application/x-www-form-urlencoded")
    with urllib.request.urlopen(req, timeout=30) as response:
        return response.read().decode("utf-8", errors="replace")


def split_php_blocks(text: str) -> List[Tuple[str, str]]:
    parts: List[Tuple[str, str]] = []
    pos = 0
    while True:
        start = text.find("<?", pos)
        if start == -1:
            parts.append(("html", text[pos:]))
            break
        parts.append(("html", text[pos:start]))
        end = text.find("?>", start + 2)
        if end == -1:
            parts.append(("php", text[start:]))
            break
        parts.append(("php", text[start : end + 2]))
        pos = end + 2
    return parts


def local_minify_html(html: str) -> str:
    if not html.strip():
        return html

    # Remove HTML comments
    html = re.sub(r"<!--.*?-->", "", html, flags=re.DOTALL)
    # Collapse whitespace between tags
    html = re.sub(r">\s+<", "><", html)
    # Collapse repeated whitespace
    html = re.sub(r"\s{2,}", " ", html)
    return html.strip()


def try_detect_form_config(page_html: str) -> Tuple[str, str] | None:
    # Best-effort: find first <form> and textarea name
    form_action_match = re.search(r"<form[^>]*action=\"([^\"]+)\"", page_html)
    textarea_name_match = re.search(r"<textarea[^>]*name=\"([^\"]+)\"", page_html)
    if not form_action_match or not textarea_name_match:
        return None
    return form_action_match.group(1), textarea_name_match.group(1)


def remote_minify_html(html: str, remote_url: str, form_action: str | None, form_field: str | None) -> str | None:
    if not html.strip():
        return html

    try:
        page = http_get(remote_url)
    except Exception:
        return None

    detected = try_detect_form_config(page)
    action_url = None
    field_name = None

    if form_action and form_field:
        action_url = form_action
        field_name = form_field
    elif detected:
        action_url, field_name = detected

    if not action_url or not field_name:
        return None

    if not action_url.startswith("http"):
        action_url = urllib.parse.urljoin(remote_url, action_url)

    try:
        response = http_post(action_url, {field_name: html})
    except Exception:
        return None

    # If the response looks like a full HTML page, the API is not exposed.
    if "<html" in response.lower():
        return None

    return response.strip()


def minify_php_file(text: str, use_remote: bool, remote_url: str, form_action: str | None, form_field: str | None) -> str:
    parts = split_php_blocks(text)
    out: List[str] = []
    for kind, chunk in parts:
        if kind == "php":
            out.append(chunk)
            continue
        if use_remote:
            minified = remote_minify_html(chunk, remote_url, form_action, form_field)
            if minified is None:
                minified = local_minify_html(chunk)
        else:
            minified = local_minify_html(chunk)
        out.append(minified)
    return "".join(out)


def iter_php_files(root: Path) -> Iterable[Path]:
    for path in root.rglob("*.php"):
        if path.is_file():
            yield path


def main() -> int:
    parser = argparse.ArgumentParser(description="Minify HTML parts of PHP views.")
    parser.add_argument("--src", default="views", help="Source folder to scan (default: views)")
    parser.add_argument("--out", default="minified", help="Output folder (default: minified)")
    parser.add_argument("--remote-url", default=DEFAULT_REMOTE_URL, help="php-minify.com HTML minify page")
    parser.add_argument("--form-action", default=None, help="Override form action URL")
    parser.add_argument("--form-field", default=None, help="Override textarea field name")
    parser.add_argument("--no-remote", action="store_true", help="Disable remote minify and use local only")
    args = parser.parse_args()

    repo_root = Path(__file__).resolve().parents[1]
    src_root = (repo_root / args.src).resolve()
    out_root = (repo_root / args.out).resolve()

    if not src_root.exists():
        print(f"Source folder not found: {src_root}", file=sys.stderr)
        return 1

    use_remote = not args.no_remote

    files = list(iter_php_files(src_root))
    if not files:
        print("No PHP files found.")
        return 0

    for file_path in files:
        rel = file_path.relative_to(src_root)
        out_path = out_root / rel
        out_path.parent.mkdir(parents=True, exist_ok=True)

        text = file_path.read_text(encoding="utf-8", errors="replace")
        minified = minify_php_file(text, use_remote, args.remote_url, args.form_action, args.form_field)
        out_path.write_text(minified, encoding="utf-8")

    print(f"Minified {len(files)} file(s) to {out_root}")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
