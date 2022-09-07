<template>
    <div id="app">
        <header-component></header-component>
        <router-view></router-view>
        <footer-component></footer-component>
    </div>
</template>

<script>
import FooterComponent from "../pages/components/FooterComponent.vue";
import HeaderComponent from "../pages/components/HeaderComponent.vue";

export default {
    name: "App",
    components: { FooterComponent, HeaderComponent },
    created() {
        console.log(this.$user);
    },
};
</script>

<style lang="scss" scoped>
#app {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}
</style>
