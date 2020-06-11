export default {
    namespaced:true,
    state:{
        buyers:[],
        pagination:"",

    },
    getters:{
        getBuyers(state){
            return state.buyers;
        },
        getPagination(state,pagination){
            return state.pagination;
        }
    },
    mutations:{
        setBuyers(state,buyers){
            state.buyers=buyers;
        },
        setPagination(state,pagination){
            state.pagination=pagination;
        }
    },
    actions:{
        fetchBuyers({commit},page_url) {
            page_url = page_url || '/api/admin/buyers';
            setTimeout(()=>{
                fetch(page_url)
                    .then(res => res.json())
                    .then(res => {
                        var buyers =res.data;
                        commit("setBuyers",buyers);
                        let pagination = {
                            current_page: res.current_page,
                            last_page: res.last_page,
                            total:res.total,
                            next_page_url: res.next_page_url,
                            prev_page_url: res.prev_page_url
                        };
                        commit("setPagination",pagination);
                    })
                    .catch(err => console.log(err));
            },100);

        },
    },
}
