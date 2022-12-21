import { actions } from './actions';
import { mutations } from './mutations';

const state = {
    errorsObject: {}
};

export const errors = {
    state,
    actions,
    mutations
};
