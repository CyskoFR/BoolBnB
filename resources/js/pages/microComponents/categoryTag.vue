<template>
    <div
        @click="clickCategory(category)"
        class="category_tag d-flex text-center"
    >
        <img
            :class="{ click: observable.category_id == category.id }"
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
    methods: {
        clickCategory(cat) {
            if (observable.category_id == this.category.id) {
                observable.category_id = null;
                observable.category_name = "";
            } else {
                observable.category_id = this.category.id;
                observable.category_name = this.category.name;
            }
        },
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
    .category_img.click {
        background-color: $primary-green-dark;
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
.active_tag {
    .category_img {
        background-color: rgb(255, 227, 116);
    }
}
</style>
