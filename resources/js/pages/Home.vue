<template>
    <main>
        <HeaderComponent/>
        <MainComponent class="main_component"/>
        <FooterComponent/>
    </main>
</template>

<script>

import HeaderComponent from './components/HeaderComponent.vue';
import MainComponent from './components/MainComponent.vue';
import FooterComponent from './components/FooterComponent.vue';

export default {
    name: "Home",
    components: { 
        HeaderComponent, 
        MainComponent, 
        FooterComponent 
    }
};
</script>

<style lang="scss" scoped>
    main {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }
    .main_component {
        flex-grow: 1;
    }
</style>