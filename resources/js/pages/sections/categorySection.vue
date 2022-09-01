<template>
    <section class="category_section container-fluid d-flex">
        <categoryTag :category="category" v-for="category in categories" :key="category.id"/>
    </section>
</template>

<script>

import categoryTag from '../microComponents/categoryTag.vue';

export default {
    
    name: "categorySection",

    components: {
        categoryTag,
    },

    data() {
        return {
            categories: []
        }
    },

    created() {
        axios.get('/api/categories')
            .then((response) => {
                this.categories = response.data;
            });
    }
};

</script>

<style lang="scss" scoped>

@import '../../../sass/variables';

    .category_section {
        align-items: flex-start;
        background-color: $bg-secondary-dark;
        border-bottom: 1px solid $text-gray-dark;
        overflow: auto;
        justify-content: space-between;
    }

</style>