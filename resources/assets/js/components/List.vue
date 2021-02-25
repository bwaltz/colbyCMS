<template>
    <ul class="subList">
        <li :key="item.id" v-for="item in items">
            <a17-checkbox :name="item.title" :label="item.title" :value="true" />
            <a17-list
                v-if="item.children && item.children.length > 0"
                :categories="item.children"
            ></a17-list>
        </li>
    </ul>
</template>
<script>
    import a17Checkbox from '@/components/Checkbox.vue';
    export default {
        name: 'a17-list',
        components: {
            'a17-checkbox': a17Checkbox,
        },
        props: {
            categories: {
                type: Array,
                required: true,
            },
        },
        data: function () {
            return {
                items: this.categories,
            };
        },
    };
</script>
<style scoped>
    .subList {
        padding-left: 1rem;
    }
</style>
