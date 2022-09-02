<template>
    <main>
        <HeaderComponent/>
        <FooterComponent/>
    </main>
</template>

<script>

import HeaderComponent from './components/HeaderComponent.vue';
import FooterComponent from './components/FooterComponent.vue';

export default {
    name: "SearchPage",
    components: { HeaderComponent, FooterComponent },


};
</script>

<style lang="scss" scoped>
@import '../../sass/variables';
    
</style>