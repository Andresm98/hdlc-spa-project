// store/index.js

import Vuex from "vuex";
import daughter from "./modules/daughter";
import address from "./modules/address";

const debug = process.env.NODE_ENV !== "production";

const store = new Vuex.Store({
    state: {
        obj: { message: "Evento Inicial" },
    },
    getters: {},
    mutations: {
        updateMessage(state, message) {
            state.obj.message = message;
        },
    },
    actions: {},
    modules: {
        daughter,
        address,
    },
    // strict: debug,
});

export default store;
