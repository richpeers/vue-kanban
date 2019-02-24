export const fetchBoards = ({commit}) => {
    return axios.get('/api/me').then((response) => {
        commit('setBoards', response.data.data);
    })
};
