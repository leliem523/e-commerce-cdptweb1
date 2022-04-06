import React, { useContext, useEffect, useState } from 'react';

// Components:
import ProductListByCategory from './ProductListByCategory';

// Context:
import { AuthContext } from '../../Contexts/AuthContext';

// Redux:
import { useDispatch, useSelector } from 'react-redux';
import { clearAll, getProductsByCategory } from '../../redux/reducers/productsByCategory';
import { addNewProductList, addNewCategoryName } from '../../redux/reducers/productsByCategory';

// CSS:
import '../../assets/css/ProductListsWrapper.css';


function ProductListsWrapper(props) {
    //  States:
    const [isDataLoaded, setIsDataLoaded] = useState(false);

    // Context
    const authCtx = useContext(AuthContext);

    // Redux
    const listOfProductLists = useSelector(state => state.productsByCategory.listOfProductLists);
    const listOfCategoryNames = useSelector(state => state.productsByCategory.listOfCategoryNames);
    const categories = useSelector(state => state.categories.categories);
    const dispatch = useDispatch();

    useEffect(() => {
        // Get the list of product lists:
        if (isDataLoaded === false && listOfProductLists.length === 0) {
            if (categories.length !== 0) {
                setIsDataLoaded(true);
                for (let i = 0; i < categories.length && i < 3; i++) {
                    const payload = {
                        token: authCtx.token,
                        key: categories[i].id,
                    }
                    const action = getProductsByCategory(payload)
                    dispatch(action)
                        .then((response) => {
                            // Get all products that belong to a category:
                            const action1 = addNewProductList(response.payload);
                            dispatch(action1);

                            // Get category name to be displayed:
                            const action2 = addNewCategoryName(categories[i].name);
                            dispatch(action2);
                        });
                }
            }
        }
    }, [categories]);

    return (
        <div className='productLists-wrapper'>
            {
                listOfProductLists.map((element, index) => {
                    if (element.length !== 0) {
                        return (
                            <div className={`p-list product-list-${index + 1}`} key={`product-list-${index + 1}`}>
                                <ProductListByCategory title={listOfCategoryNames[index]} products={element}></ProductListByCategory>
                            </div>
                        );
                    }
                    else {
                        return (
                            <div key={`product-list-${index + 1}`}></div>
                        );
                    }
                })
            }
        </div>
    );
}

export default ProductListsWrapper;