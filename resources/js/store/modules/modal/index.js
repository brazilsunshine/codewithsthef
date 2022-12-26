import { mutations } from "./mutations";

const state = {
    show: false, // (show modal) false by default, and we are going to use our mutations to update it
    title: '', // title of the modal
    innerComponent: '' // this will be the main component, the component inside the model
}

export const modal = {
    state,
    mutations
}
