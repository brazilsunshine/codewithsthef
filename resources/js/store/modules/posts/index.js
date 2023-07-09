import { actions } from './actions';
import { getters } from './getters';
import { mutations } from './mutations';

const state = {
    paginated: null,
    post: null,
    viewCount: 0,
    editPostTitle: null,
    editPostDescription: null,
    blogHTML: "",
    blogTitle: "",
    blogPhotoName: "",
    blogPhotoFileURL: null,
    blogPhotoPreview: null,
};

export const posts = {
    state,
    actions,
    getters,
    mutations
};
