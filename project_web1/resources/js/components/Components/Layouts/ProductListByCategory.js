import React, { useContext, useEffect, useRef, useState } from 'react';

// Modules:
import swal from 'sweetalert';
import { Row, Col } from 'antd';
import { Pagination } from 'antd';
import { Modal, Button } from 'antd';

// Components:
import Modal_ProductDetail from './../ModalBoxContent/Modal_ProductDetail';

// Context:
import { AuthContext } from '../../Contexts/AuthContext';

// Redux:
import { useDispatch } from 'react-redux';
import { addCartItem } from '../../redux/reducers/cart';

// CSS:
import '../../assets/css/ListOfProducts.css';


const formatCash = (str) => {
    return str.split('').reverse().reduce((prev, next, index) => {
        return ((index % 3) ? next : (next + '.')) + prev
    })
}

function ProductListByCategory(props) {
    // __________________________________________________
    // Context:
    const authCtx = useContext(AuthContext);


    // __________________________________________________
    // Redux:
    const dispatch = useDispatch();

    
    // __________________________________________________
    // List of products:
    const [currentPage, setCurrentPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);
    const [pageStart, setPageStart] = useState(0);
    const [pageEnd, setPageEnd] = useState(0);
    const resultsPerPage = useRef(12);

    const onChange_PageNumber = (pageNumber) => {
        setCurrentPage(pageNumber);
    }

    const handleClickToBuy = (product) => {
        const params = {
            id_product: product.id,
            name: product.name,
            quantity: 1,
        }
        const payload = {
            token: authCtx.token,
            params: params
        }
        const action = addCartItem(payload);
        dispatch(action);
    }

    useEffect(() => {
        setTotalPages(Math.ceil(props.products.length / resultsPerPage.current));
    }, [totalPages, props.products.length]);

    useEffect(() => {
        setPageStart((currentPage - 1) * resultsPerPage.current);
        setPageEnd(pageStart + resultsPerPage.current - 1);
    }, [currentPage, pageStart, pageEnd]);


    // __________________________________________________
    // Modal box:
    const [isModalVisible, setIsModalVisible] = useState(false);
    const [indexOfSelectedItem, setIndexOfSelectedItem] = useState(-1);
    const [productSelected, setProductSelected] = useState({});

    const setContentInModal = (i, product) => {
        setIndexOfSelectedItem(i);
        setProductSelected(product);
        showModal();
    }

    const showModal = () => {
        setIsModalVisible(true);
    };

    const handleOk = () => {
        setIsModalVisible(false);
    };

    const handleCancel = () => {
        setIsModalVisible(false);
    };


    // __________________________________________________
    // Component:
    return (
        <>
            {/* List of products to be displayed: */}
            <div className="list-of-products">
                <div className="list-title">{props.title}</div>

                <div className="products">
                    <Row>
                        {
                            props.products.map((product, index) => {
                                if (index >= pageStart && index <= pageEnd) {
                                    return (
                                        <Col xs={12} sm={8} md={6} lg={6} xl={4} key={`product-item-${index}`} name={`product-item-${index}`}>
                                            <div className="product-quick-info">
                                                <div className="product-img-wrapper" onClick={() => { return setContentInModal(index, product); }}>
                                                    <img className="product-img" alt={`product-img`} src={product.image}></img>
                                                </div>
                                                <div className="product-quick-info-name" onClick={() => { return setContentInModal(index, product); }}>
                                                    {product.name}
                                                    <div className="hidden-div">...</div>
                                                </div>
                                                <div className="product-quick-info-price">{formatCash(product.price.toString())}₫</div>
                                                <button className="buy-btn" onClick={() => handleClickToBuy(product)}>Chọn mua</button>
                                            </div>
                                        </Col>
                                    );
                                }
                                else {
                                    return (null);
                                }
                            })
                        }
                    </Row>
                </div>

                <div className="products__pagination">
                    <Pagination current={currentPage} total={(totalPages * 10)} onChange={onChange_PageNumber} showSizeChanger={false} />
                </div>
            </div>

            {/* Product detail modal box: */}
            <div className="products__modalbox">
                <Modal title={`Thông tin sản phẩm #${indexOfSelectedItem}`} visible={isModalVisible} onOk={handleOk} onCancel={handleCancel}>
                    <Modal_ProductDetail product={productSelected} content={indexOfSelectedItem}></Modal_ProductDetail>
                </Modal>
            </div>
        </>
    );

}

export default ProductListByCategory;