<template>
    <main>
        <CategorySection/>
    </main>
</template>

<script>

import CategorySection from '../sections/categorySection.vue';

export default {

    name: "MainComponent",

    components: { 
        CategorySection,
    }
};

</script>

<style lang="scss" scoped>

@import '../../../sass/variables';

main {
    background-color: $bg-primary-dark;
    height: 100vh;
}

</style>