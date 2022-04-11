const state = () => ({
    allAppointment: null,
    appointment: {
        description: "",
        date_appointment: "",
        date_end_appointment: "",
        appointment_level_id: "",
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
