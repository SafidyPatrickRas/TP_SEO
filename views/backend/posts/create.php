<div class="page-header">
	<div>
		<h2 class="page-title">Creer un article</h2>
		<p class="page-meta">Saisissez le contenu a publier.</p>
	</div>
</div>

<form action="/admin/articles" class="card form-card" method="post" id="post-form">
	<div class="form-field">
		<label for="title">Titre</label>
		<input class="form-input" id="title" name="title" required>
	</div>
	<div class="form-field">
		<label for="content">Contenu</label>
		<textarea class="form-textarea" id="content" name="content" rows="8"></textarea>
	</div>
	<div class="form-field">
		<label for="status">Statut</label>
		<select class="form-select" id="status" name="status">
			<option value="draft">Brouillon</option>
			<option value="published">Publie</option>
		</select>
	</div>
	<button class="btn btn-primary" type="submit">Enregistrer</button>
</form>
<script src="https://cdn.tiny.cloud/1/cg9ppftk6e2vvgi45f55g3j2dlmnhhs5mcmi7zz4fqt03cih/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
<script>
	tinymce.init({
		selector: '#content',
		height: 500,
		plugins: [
			'advlist', 'autolink', 'lists', 'link', 'image', 'charmap',
			'preview', 'anchor', 'searchreplace', 'visualblocks',
			'code', 'fullscreen', 'insertdatetime', 'media', 'table'
		],
		toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | code',
		setup: (editor) => {
			editor.on('change', () => editor.save());
		}
	});

	const form = document.getElementById('post-form');
	if (form) {
		form.addEventListener('submit', (event) => {
			tinymce.triggerSave();
			const editor = tinymce.get('content');
			const content = editor ? editor.getContent({ format: 'text' }).trim() : '';
			if (!content) {
				event.preventDefault();
				alert('Veuillez saisir le contenu de l\'article.');
				if (editor) {
					editor.focus();
				}
			}
		});
	}
</script>