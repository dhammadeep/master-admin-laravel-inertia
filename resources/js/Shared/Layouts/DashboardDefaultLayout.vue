<template>
	<div class="d-flex">
		<div class="sidebarParentContainer" :class="sidebarSts ? 'open' : 'close'">
			<SidebarTemplate />
		</div>

		<div class="mainParentContainer">
			<HeaderTemplate @toggleMode="changeModeSts" @toggleSidebar="changeSidebarSts" :data="data" :title="title" :url="url" :type="type" />
			<main :class="sidebarSts ? 'spread' : 'collapsed'">
				<div class="container-fluid fixWidthContainer" style="max-width: 1737px; margin: 0 auto">
					<slot :text="greetingMessage" />
				</div>
			</main>
		</div>
	</div>

	<Footer />
</template>

<script>
import SidebarTemplate from "../Sidebar/SidebarTemplate.vue";
import HeaderTemplate from "../Header/HeaderTemplate.vue";
import Footer from "../Footer.vue";
export default {
	props: {
		url: String,
		title: String,
		type: String,
	},
	components: {
		SidebarTemplate,
		HeaderTemplate,
		Footer,
	},
	data() {
		return {
			greetingMessage: "",
			sidebarSts: true,
			data: {
				value: false,
				darkmode: true,
				pageTitle: "Home",
				userName: this.$page.props.auth.user.username,
			},
		};
	},
	methods: {
		changeSidebarSts() {
			this.sidebarSts = !this.sidebarSts;
			if (this.sidebarSts != true) {
				this.data.value = true;
			} else {
				this.data.value = false;
			}
		},

		changeModeSts() {
			// let classes = document.body;
			// let currentMode = this.data.darkmode;
			// if (currentMode) {
			// 	classes.classList = "";
			// 	classes.classList.add("light");
			// 	this.data.userName = "Prakash";
			// 	this.data.pageTitle = "Change";
			// 	return (this.data.darkmode = false);
			// } else {
			// 	classes.classList = "";
			// 	classes.classList.add("dark");
			// 	this.data.userName = "Shivani";
			// 	this.data.pageTitle = "Home";
			// 	return (this.data.darkmode = true);
			// }
		},

		checkScreenSize() {
			if (screen.width <= 768) {
				this.sidebarSts = false;
				this.data.value = true;
			} else {
				this.sidebarSts = true;
				this.data.value = false;
			}
			return this.sidebarSts, this.data.value;
		},
	},
	mounted() {
		// document.body.classList.add("dark");
		this.checkScreenSize();
		window.addEventListener("resize", () => {
			this.checkScreenSize();
		});
	},
};
</script>
