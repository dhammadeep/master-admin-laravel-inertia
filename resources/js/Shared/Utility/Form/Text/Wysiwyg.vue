<template>
	<div class="col-12 mb-3">
		<label for="Editor" class="form-label">Editor</label>
		<ckeditor :editor="editor" v-model="editorData" :config="editorConfig"></ckeditor>
	</div>
</template>
<script>
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
export default {
	name: "editor",
	data() {
		return {
			editor: ClassicEditor,
			editorData: "",
			editorConfig: {
				// The configuration of the editor.
			},
		};
	},
};
</script>
