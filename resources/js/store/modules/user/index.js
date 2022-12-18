import { actions } from './actions';
import { getters } from './getters';
import { mutations } from './mutations';

const state = {
    admin: false,
    auth: false,
    userObject: null,
};

export const user = {
    state,
    getters,
    actions,
    mutations
};
