const state = () => ({
    inventory: {
        name: null,
        description: null,
        community_id: null,
    },
    // Section
    allSection: null,
});

const getters = {
    getInventory: (state) => {
        return state.inventory;
    },

    getAllSection: (state) => {
        return state.allSection;
    },
};

const mutations = {
    addInventory(state, payload) {
        state.inventory = payload;
    },
    addSection(state, payload) {
        state.allSection = payload;
    },
};

const actions = {
    updateInventory(context, payload) {
        context.commit("addInventory", payload);
    },
    updateAllSection(context, payload) {
        context.commit("addSection", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
