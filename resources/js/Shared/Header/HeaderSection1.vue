<template>
	<section class="headerSection1">
		<h4 class="mainPageTitle">{{ title }}</h4>
		<div class="rightTemplate">
			<div class="modeToggle me-3 d-flex align-items-center" @click="updateTemplateMode()">
				<span>
					<i class="bi" :class="templateMode.templateModeValue == 'dark' ? 'bi-sun-fill darkMode' : 'bi-moon-fill lightMode'" type="button" title="Toggle Mode"></i>
				</span>
			</div>
			<div class="briefProfile me-3">Hello, {{ data.userName }}</div>
			<div class="notifications ctm-btn me-3"><i class="fa-solid fa-bell"></i></div>
			<div class="userProfile ctm-btn me-3 dropdown-toggle no-caret" data-bs-toggle="dropdown" aria-expanded="false">
				<i class="fa-solid fa-user"></i>

				<div class="dropdown"><UserDropdown /></div>
			</div>
			<div class="menuToggle ctm-btn" :class="data.value ? '' : 'active'" @click="this.$emit('toggleSidebar')">
				<span v-if="data.value">
					<i class="fa-solid fa-bars"></i>
				</span>
				<span v-else>
					<i class="fa-solid fa-close"></i>
				</span>
			</div>
		</div>
	</section>
</template>

<script>
import UserDropdown from "./UserDropdown";
import { templateMode } from "../templateStore";
export default {
	components: {
		UserDropdown,
	},
	props: {
		title: String,
		data: Object,
	},
	data() {
		return {
			templateMode,
			mode: templateMode.templateModeValue,
		};
	},
	methods: {
		updateTemplateMode() {
			if (this.mode == "dark") {
				this.mode = "light";
			} else if (this.mode == "light") {
				this.mode = "dark";
			} else {
				this.mode = "";
			}
			this.templateMode.setTemplateModeValue(this.mode);
			sessionStorage.setItem("templateMode", this.mode);
		},
	},

	mounted() {
		if (sessionStorage.templateMode) {
			this.mode = sessionStorage.getItem("templateMode");
			this.templateMode.setTemplateModeValue(this.mode);
		} else {
			this.mode = "dark";
			this.templateMode.setTemplateModeValue(this.mode);
			sessionStorage.setItem("templateMode", this.mode);
		}
	},
};
</script>
