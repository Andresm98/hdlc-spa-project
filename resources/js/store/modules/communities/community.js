const state = () => ({
    community: {
        comm_identity_card: null,
        comm_name: null,
        comm_cellphone: null,
        comm_phone: null,
        comm_email: null,
        date_fndt_comm: null,
        date_fndt_work: null,
        rn_collaborators: null,
        address: null,
    },
});

const getters = {
    communityInfo: (state) => {
        return state.community;
    },
};

const mutations = {
    loadCommunity(state, payload) {
        state.community = payload;
    },
};

const actions = {
    changeCommunity(context, payload) {
        // setTimeout(() => {
        context.commit("loadCommunity", payload);
        // }, 2000);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
};
