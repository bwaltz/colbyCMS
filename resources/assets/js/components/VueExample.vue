<template>
    <div>
        <a17-list :categories="items"></a17-list>
    </div>
</template>
<script>
    import List from './List.vue';
    export default {
        name: 'vue-example',
        components: {
            'a17-list': List,
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
