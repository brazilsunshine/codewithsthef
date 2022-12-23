import { actions } from './actions';
import { getters } from './getters';
import { mutations } from './mutations';

const state = {
    auth: false,
    userObject: null,
};

export const user = {
    state,
    getters,
    actions,
    mutations
};
