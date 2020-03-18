import BuyersTable from './components/buyersTable';
import SellersTable from './components/sellersTable';
import supervisorsTable from './components/supervisorsTable';
import deliverysTable from './components/deliveryTable';

const routes = [
    { path: '/',name:'buyersTable', component: BuyersTable },
    { path: '/sellers',name:'sellersTable', component: SellersTable },
    { path: '/supervisors',name:'supervisorsTable', component: supervisorsTable },
    { path: '/delivery',name:'deliverysTable', component: deliverysTable },
];

export default routes;
