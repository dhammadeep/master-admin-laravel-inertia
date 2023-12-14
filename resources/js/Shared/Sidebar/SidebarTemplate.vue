<template>
    <div>
        <SidebarLogo />
        <SearchMenu />
        <Nav />
    </div>
</template>

<script>
import SidebarLogo from "./SidebarLogo.vue";
import SearchMenu from "./SearchMenu.vue";
import Nav from "./Nav.vue";
export default {
    components: {
        SidebarLogo,
        SearchMenu,
        Nav,
    },
};
</script>
