// store/index.js

import Vuex from "vuex";
import daughter from "./modules/daughter";
import address from "./modules/address";
import health from "./modules/health";
import academic from "./modules/academic_training";
import informationfamily from "./modules/info_family";
import sacrament from "./modules/sacrament";
import permit from "./modules/permit";
import appointment from "./modules/appointment";

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
        health,
        academic,
        informationfamily,
        sacrament,
        permit,
        appointment,
    },
    // strict: debug,
});

export default store;
