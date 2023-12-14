<template>
    <nav class="my-3">
        <ul class="pagination">
            <li
                class="page-item"
                v-for="link in links"
                :key="link.url"
                :class="{ disabled: !link.url, active: link.active }"
            >
                <Link
                    :href="link.url"
                    v-html="link.label"
                    class="page-link"
                    :class="link.url ? '' : 'text-gray-500'"
                />
            </li>
        </ul>
    </nav>
</template>
<script>
export default {
    props: {
        links: Array,
    },
};
</script>
