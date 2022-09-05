<template>
    <div
        @click="observable.category_id = category.id"
        class="category_tag d-flex text-center"
    >
        <img
            class="category_img"
            :src="category.image_src"
            :alt="category.name"
        />
        <p>{{ category.name }}</p>
    </div>
</template>

<script>
import observable from "../../observable";
export default {
    name: "categoryTag",

    props: {
        category: Object,
    },
    data() {
        return {
            observable,
        };
    },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/variables";

.category_tag {
    flex-direction: column;
    justify-content: center;
    align-items: center;
    min-width: 4rem;
    width: 5.375rem;
    margin: 0.5rem;
    cursor: pointer;
    transition: 0.3s;

    .category_img {
        background-color: white;
        height: 3.125rem;
        width: 3.125rem;
        border-radius: 50%;
        padding: 0.25rem;
        border: 2px solid $primary-green-dark;
    }

    p {
        font-size: 0.75rem;
        width: 100%;
        margin: 0;
        word-wrap: break-word;
        color: $text-gray-light;
    }
}
.category_tag:hover {
    filter: brightness(110%);
    scale: 105%;
}
</style>
