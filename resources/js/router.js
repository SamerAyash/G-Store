import BuyersTable from './components/buyersTable';
import SellersTable from './components/sellersTable';
import supervisorsTable from './components/supervisorsTable';
import deliverysTable from './components/deliveryTable';
import ProductsTable from './components/productsTable';
import OffersTable from './components/offerTable';
import loginComponent from './components/loginComponent';
import registerComponent from './components/registerComponent';

const routes = [
    { path: '/admin/acounts-table',name:'buyersTable', component: BuyersTable },
    { path: '/sellers',name:'sellersTable', component: SellersTable },
    { path: '/supervisors',name:'supervisorsTable', component: supervisorsTable },
    { path: '/delivery',name:'deliverysTable', component: deliverysTable },
    { path: '/admin/outstanding-products-and-offers',name:'productsTable', component: ProductsTable },
    { path: '/admin/outstanding-products-and-offers#/offers',name:'offersTable', component: OffersTable },
    //////////////////////////////////////////////////////////////////////////////
    { path: '/login',name:'loginComponent', component: loginComponent },
    { path: '/register',name:'registerComponent', component: registerComponent},
    /////////////////////////////////////////////////////////////////////////////


];

export default routes;
