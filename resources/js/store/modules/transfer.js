const state = () => ({
    allTransfer: null,
    allOffice:null,
    transfer: {
        transfer_date_adission: "",
        transfer_date_relocated: "",
        transfer_reason: "",
        transfer_observation: "",
        profile_id: null,
        community_id: null,
        office_id: null,
    },
});

const getters = {
    getAllTransfer: (state) => {
        return state.allTransfer;
    },
    getAllOffice: (state) => {
        return state.allOffice;
    },
};

const mutations = {
    addTransfer(state, payload) {
        state.allTransfer = payload;
    },
    addOffice(state, payload) {
        state.allOffice = payload;
    },
};

const actions = {
    updateAllTransfer(context, payload) {
        context.commit("addTransfer", payload);
    },
    updateAllOffice(context, payload) {
        context.commit("addOffice", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
