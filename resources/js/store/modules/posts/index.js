import { actions } from './actions';
import { mutations } from './mutations';

const state = {
    paginated: null,
    blogHTML: "",
    blogTitle: "",
    blogPhotoName: "",
    blogPhotoFileURL: null,
    blogPhotoPreview: null,
    // selectedPost: null,
};

export const posts = {
    state,
    actions,
    mutations
};
