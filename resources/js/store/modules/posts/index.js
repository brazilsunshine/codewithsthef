import { actions } from './actions';
import { mutations } from './mutations';

const state = {
    // paginated: null,
    blogHTML: "Write your blog here...",
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
