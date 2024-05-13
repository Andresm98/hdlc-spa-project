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
import transfer from "./modules/transfer";

import community from "./modules/communities/community";
import activity from "./modules/communities/activity";
import resume from "./modules/communities/resume";
import vehicle from "./modules/communities/vehicle";
import visit from "./modules/communities/visit";
import work from "./modules/communities/work";
import inventory from "./modules/communities/inventory";

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
        //
        community,
        activity,
        resume,
        visit,
        vehicle,
        work,
        transfer,
        inventory,
    },
    // strict: debug,
});

export default store;
