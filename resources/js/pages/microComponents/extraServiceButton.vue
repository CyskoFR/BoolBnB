<template>
    <button
        @click="toggleButton(service.name)"
        :class="{ active: isActive }"
        type="button"
        class="w-100 my-2"
    >
        {{ service.name }}
    </button>
</template>

<script>
import observable from "../../observable";

export default {
    name: "extraServiceButton",

    props: {
        service: Object,
    },

    data: function () {
        return {
            isActive: false,
            observable,
        };
    },

    methods: {
        // BUG
        toggleButton: function (name) {
            this.isActive = !this.isActive;
            observable.selectedServicesNames.includes(name)
                ? observable.selectedServicesNames.splice(
                      observable.selectedServicesNames.indexOf(name),
                      1
                  )
                : observable.selectedServicesNames.push(name);
            console.log(this.observable.selectedServicesNames);
        },
    },
};
</script>

<style lang="scss" scoped></style>
