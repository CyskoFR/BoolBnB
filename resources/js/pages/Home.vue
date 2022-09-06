<template>
    <main>
        <MainComponent class="main_component" />
    </main>
</template>

<script>
import MainComponent from "./components/MainComponent.vue";

export default {
    name: "Home",
    components: {
        MainComponent,
    },
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
