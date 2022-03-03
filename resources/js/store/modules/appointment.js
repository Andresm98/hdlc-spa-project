const state = () => ({
    allAppointment: null,
    appointment: {
        name_appointment: "",
        description: "",
        date_appointment: "",
        date_end_appointment: "",
    },
});

const getters = {
    getAllAppointment: (state) => {
        return state.allAppointment;
    },
};

const mutations = {
    addPermit(state, payload) {
        state.allAppointment = payload;
    },
};

const actions = {
    updateAllAppointment(context, payload) {
        context.commit("addPermit", payload);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions,
};
