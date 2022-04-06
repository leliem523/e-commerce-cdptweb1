import React, { useContext, useEffect } from 'react';
import { useHistory, useLocation, useParams } from 'react-router';
import { Spin } from 'antd';

// Components:
import LayoutWrapper from '../Components/LayoutWrapper';
import ProductList from '../Components/Layouts/ProductList';

// Context:
import { AuthContext } from '../Contexts/AuthContext';

// Redux:
import { useDispatch, useSelector } from 'react-redux';
import { clearProducts, getProducts, getProductsByCategory } from '../redux/reducers/products';
// import { getProductsByCategory } from '../redux/reducers/productsByCategory';

// CSS:
import 'antd/dist/antd.css';
import '../assets/css/Container.css';
import '../assets/css/ProductListPage.css';
import '../assets/css/LoadingSpinner.css';


function ProductListPage(props) {
    // Context:
    const authCtx = useContext(AuthContext);

    // Redux:
    const { categories } = useSelector(state => state.categories);
    const { products } = useSelector(state => state.products);
    const dispatch = useDispatch();

    // From URL:
    const categoryID = atob(useParams().slug).slice(3);
    const history = useHistory();

    const getCategoryName = (cateID) => {
        for (let i = 0; i < categories.length; i++) {
            if (parseInt(cateID) === parseInt(categories[i].id)) {
                return categories[i].name;
            }
        }
        return '';
    }

    useEffect(() => {
        // If slug is valid, get products:
        if (categoryID === 'all') {
            dispatch(clearProducts());
            dispatch(getProducts(authCtx.token));
        }
        else if (categoryID !== undefined) {
            const payload = {
                key: categoryID,
                token: authCtx.token
            }
            dispatch(clearProducts());
            dispatch(getProductsByCategory(payload))
                .then((response) => {
                    if (response.payload == undefined) {
                        history.push('/404');
                        return;
                    }
                });
        }
        else {
            history.push('/404');
            return;
        }
    }, [categoryID])

    // Page content:
    const mainContent = () => {
        if (products.length === 0) {
            return (
                <>
                    <div className="content">
                        <div className="container">
                            <Spin className='loading-spinner--default' spinning={true} delay={0}></Spin>
                        </div>
                    </div>
                </>
            );
        }
        else {
            return (
                <>
                    <div className="content">
                        <div className="container">
                            <ProductList products={products} categoryID={categoryID} title={getCategoryName(categoryID)}></ProductList>
                        </div>
                    </div>
                </>
            );
        }
    }

    // Component:
    return (
        <>
            <div className="product-list-page">
                <LayoutWrapper mainContent={mainContent}></LayoutWrapper>
            </div>
        </>
    );
}

export default ProductListPage;