import React, { useContext, useEffect, useRef, useState } from 'react';

import '../assets/css/ListOfProducts.css';

import { Row, Col, Result } from 'antd';
import { Pagination } from 'antd';
import { Modal, Button } from 'antd';

import Modal_ProductDetail from './ModalBoxContent/Modal_ProductDetail';
import swal from 'sweetalert';


import { addCartItem } from '../redux/reducers/cart';
import { useHistory } from 'react-router-dom/cjs/react-router-dom.min';

const formatCash = (str) => {
    return str.split('').reverse().reduce((prev, next, index) => {
        return ((index % 3) ? next : (next + '.')) + prev
    })
}

function ListOfProductsSearch({products, keySearch}) {

    // __________________________________________________
    // List of products:
    const [currentPage, setCurrentPage] = useState(1);
    const [totalPages, setTotalPages] = useState(1);
    const [pageStart, setPageStart] = useState(0);
    const [pageEnd, setPageEnd] = useState(0);
    const resultsPerPage = useRef(30);
    const history = useHistory();

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
    const handleBackHomeCLick = () => {
        history.push('/')
    }

    useEffect(() => {
        setTotalPages(Math.ceil(products.length / resultsPerPage.current));
    }, [totalPages, products.length]);

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
    // Alert:
    const showFeedBackFor_SuccessfulTask = (title, msg) => {
        swal({
            title: title,
            text: msg,
            icon: "success",
            button: "Ok!",
        });
    }


    // __________________________________________________
    // Component:
    return (
        <>
            {/* List of products to be displayed: */}
            <div className="list-of-products">
                <div className="list-title">{`Kết quả tìm kiếm cho '${keySearch}'`}</div>

                <div className="products">
                    <Row>
                        {
                             products.length > 0 ? products.map((product, index) => {
                                return index >= pageStart && index <= pageEnd && (
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
                            })
                            :  (
                                <div className="" style={{ margin: '0 auto' }}>
                                <Result
                                        status="warning"
                                        title="Rất tiếc, không tìm thấy sản phẩm phù hợp với lựa chọn của bạn."
                                        extra={
                                        <Button onClick={handleBackHomeCLick} type="primary" key="console">
                                            Back to home
                                        </Button>
                                    }
                                    />
                                </div>
                            )
                        }
                    </Row>
                </div>

               {
                   products.length > 30 &&
                   ( 
                        <div className="products__pagination">
                            <Pagination current={currentPage} total={(totalPages * 10)} onChange={onChange_PageNumber} />
                        </div>
                    )
               }
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

export default ListOfProductsSearch;