import BuyersTable from './components/buyersTable';
import SellersTable from './components/sellersTable';
import supervisorsTable from './components/supervisorsTable';
import deliverysTable from './components/deliveryTable';
import ProductsTable from './components/productsTable';
import OffersTable from './components/offerTable';

const routes = [
    { path: '/',name:'buyersTable', component: BuyersTable },
    { path: '/sellers',name:'sellersTable', component: SellersTable },
    { path: '/supervisors',name:'supervisorsTable', component: supervisorsTable },
    { path: '/delivery',name:'deliverysTable', component: deliverysTable },
    { path: '/products',name:'productsTable', component: ProductsTable },
    { path: '/offers',name:'offersTable', component: OffersTable },
];

export default routes;
