import { actions } from './actions';
import { mutations } from './mutations';

const state = {
    paginated: null,
    post: null,
    tags: null,
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
    mutations
};
