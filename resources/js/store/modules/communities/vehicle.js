const state = () => ({
    allVehicle: null,
    vehicle: {
        brand: null,
        type: null,
        color: null,
        plaque: null,
        year: null
    }
})

const getters = {
    getAllVehicle: (state) => {
        return state.allVehicle;
    }
}

const mutations = {
    addVehicle(state, payload) {
        state.allVehicle = payload;
    }
}

const actions = {
    updateAllVehicle(context, payload) {
        context.commit('addVehicle', payload);
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}

