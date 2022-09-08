<template>
    <header>
        <div
            class="header_component container-fluid d-flex justify-content-between align-items-center"
        >
            <a class="logo_link" href="/">
                <img
                    class="logo_img"
                    src="../../../img/logo_boolbnb.png"
                    alt="logo"
                />
            </a>
            <div class="mode_toggle" @click="modeToggle" :class="lightLight">
                <div class="toggle">
                    <div id="switch" type="checkbox"></div>
                </div>
            </div>
            <div
                class="header_user d-flex align-items-center justify-content-center"
            >
                <div class="dropdown">
                    <button
                        v-if="$user"
                        class="user_dropdown btn dropdown-toggle"
                        type="button"
                        id="dropdownMenuButton"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <b>{{ $user.first_name }} {{ $user.last_name }}</b>
                    </button>
                    <button
                        v-else
                        class="user_dropdown btn dropdown-toggle"
                        type="button"
                        id="dropdownMenuButton"
                        data-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                    >
                        <b>Utente</b>
                    </button>
                    <div
                        v-if="$user"
                        class="dropdown-menu"
                        aria-labelledby="dropdownMenuButton"
                    >
                        <a class="dropdown-item" href="/admin/apartments"
                            >Area personale</a
                        >
                        <a class="dropdown-item" href="/" @click.prevent="logout">Logout</a>
                        <!-- <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Logout</a> -->
                    </div>
                    <div
                        v-else
                        class="dropdown-menu"
                        aria-labelledby="dropdownMenuButton"
                    >
                        <a class="dropdown-item" href="/login">Accedi</a>
                        <a class="dropdown-item" href="/register">Registrati</a>
                    </div>
                </div>
                <div
                    class="header_user_icon d-flex align-items-center justify-content-center"
                >
                    <font-awesome-icon icon="fa-regular fa-user" />
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: "HeaderComponent",

    data() {
        return {
            lightMode: false,
        };
    },

    components: {},

    methods: {
        light() {
            document
                .querySelector(".header_component")
                .classList.add("light_mode");
            this.lightMode = true;
            this.$emit("light");
        },

        dark() {
            document
                .querySelector(".header_component")
                .classList.remove("light_mode");
            this.lightMode = false;
            this.$emit("dark");
        },

        modeToggle() {
            if (
                this.lightMode ||
                document
                    .querySelector(".header_component")
                    .classList.contains("light_mode")
            ) {
                this.dark();
            } else {
                this.light();
            }
        },

        logout(){
            axios.post('logout').then(response => {
                if (response.status === 302 || 401) {
                    location.reload();
                }
                else {
                    // throw error and go to catch block
                }
                }).catch(error => {

            });
        },
    },

    computed: {
        lightLight() {
            return this.lightMode && "lightMode_toggled";
        },
    },
};
</script>

<style lang="scss" scoped>
@import "../../../sass/variables";

header {
    background-color: $bg-primary-dark;
    border-bottom: 1px solid $text-gray-dark;
}

.header_component {
    height: 4.375rem;
    max-width: 125rem;
    background-color: $bg-primary-dark;
    padding: 1rem 1.5rem;
}

.logo_link,
.logo_img {
    height: 100%;
}

.user_dropdown {
    color: $text-gray-light;
}
.user_dropdown:focus,
.user_dropdown:active {
    box-shadow: none !important;
}

.header_user_icon {
    height: 2.5rem;
    width: 2.5rem;
    border: 2px solid $primary-green;
    border-radius: 50%;
}

.fa-user {
    color: $primary-green;
}

//------------------------- BETA SWITCH ------------------------- //
.mode_toggle {
    position: relative;
    padding: 0;
    width: 44px;
    height: 24px;
    min-width: 44px;
    background-color: $bg-primary-light;
    border: 0;
    border-radius: 24px;
    outline: 0;
    overflow: hidden;
    cursor: pointer;
    z-index: 2;
    -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    -webkit-touch-callout: none;
    appearance: none;
    transition: background-color 0.5s ease;

    .toggle {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        margin: auto;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        border: 3px solid transparent;
        box-shadow: inset 0 0 0 2px $primary-green-dark;
        overflow: hidden;
        transition: transform 0.5s ease;
    }
}

.header_component.light_mode {
    background-color: whitesmoke;
    .user_dropdown {
        color: $bg-primary-light;
    }
    .mode_toggle {
        background-color: $primary-green;

        .toggle {
            transform: translateX(22px);
            box-shadow: inset 0 0 0 2px $bg-primary-light;
        }
    }
}
//------------------------- /BETA SWITCH ------------------------- //
</style>
