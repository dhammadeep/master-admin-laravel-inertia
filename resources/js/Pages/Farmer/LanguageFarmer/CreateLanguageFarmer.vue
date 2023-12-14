<template>
	<Head>
		<title>Language Farmer</title>
	</Head>

	<FormBuilder :fields="fields" :url="url" />
</template>

<script>
import FormBuilder from "../../../Shared/Utility/Form/FormBuilder";

export default {
    name: "create-languageFarmer",
	components: {
		FormBuilder,
	},
	props: {
		title: String,
		url: String,
		fields: Array,
	},
};
</script>
