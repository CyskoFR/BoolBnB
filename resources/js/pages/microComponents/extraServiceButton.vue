<template>
    <button @click="toggleButton()" :class="{'active': isActive}" type="button" class="w-100 my-2">{{ service.name }}</button>
</template>

<script>
export default {
    name: "extraServiceButton",

    props: {
        service: Object,
    },

    data: function() {
        return {
            isActive: false,
        }
    },
    
    methods: {
        toggleButton: function() {
            this.isActive = !this.isActive;    
        }
    }
}

</script>

<style lang="scss" scoped>

</style>