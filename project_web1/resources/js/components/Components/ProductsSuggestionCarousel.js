import React, { useContext, useEffect, useState } from 'react';
import { Carousel, Modal } from 'antd';
import { useDispatch, useSelector } from 'react-redux';
import { clearProducts, getProductsByCategory } from '../redux/reducers/products';
import { AuthContext } from '../Contexts/AuthContext';
import '../assets/css/ProductsSuggestionCarousel.css';
import Modal_ProductDetail from './ModalBoxContent/Modal_ProductDetail';
import { addCartItem } from '../redux/reducers/cart';


const formatCash = (str) => {
    return str.split('').reverse().reduce((prev, next, index) => {
        return ((index % 3) ? next : (next + '.')) + prev
    })
}


const ProductsSuggestionCarousel = ({categoryId, isModalVisible, setIsModalVisible}) => {

    const dispatch = useDispatch();
    const authCtx = useContext(AuthContext);
    const {products} = useSelector(state => state.products);

    const [isDisplay, setIsDisplay] = useState(true)

    // Cấu hình carousel:
    const [settings, setSettings] = useState(null);


    useEffect(() => {
        const payload = {
            token: authCtx.token,
            key: categoryId,
        }
        dispatch(clearProducts());
        dispatch(getProductsByCategory(payload))
            .then((response) => {
                if (response.payload.length > 5) {
                    setSettings({
                        dots: false,
                        infinite: true,
                        speed: 800,
                        slidesToShow: 5,
                        slidesToScroll: 1,
                        autoplay: true,
                    });
                }
                else {
                    setSettings({
                        dots: false,
                        infinite: false,
                        speed: 800,
                        slidesToShow: 5,
                        slidesToScroll: 0,
                        autoplay: false,
                    });
                }
            });
    }, [categoryId]);

    const [indexOfSelectedItem, setIndexOfSelectedItem] = useState(-1);
    const [productSelected, setProductSelected] = useState({});

    const handleClickToHidden = () => {
        swal({
            title: "Ẩn mục sản phẩm tương tự",
            text: `Danh mục sản phẩm tương tự sẽ bị ẩn, bạn có muốn tiếp tục không ?`,
            icon: "warning",
            buttons: ['Hủy bỏ', 'Xác nhận'],
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              setIsDisplay(false);
              swal(`Ẩn danh mục sản phẩm tương tự thành công !!`, {
                icon: "success",
              });
            }
          });
    }

    const setContentInModal = (i, product) => {
        setIndexOfSelectedItem(i);
        setProductSelected(product);
        showModal();
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

    const showModal = () => {
        setIsModalVisible(true);
    };

    const handleOk = () => {
        setIsModalVisible(false);
    };

    const handleCancel = () => {
        setIsModalVisible(false);
    };

    
    return (
        <React.Fragment>
        {
            isDisplay && products.length > 0 && 
            <div className="product-suggestion">
            <div className="header-product-suggestion">
                <h3>Sản phẩm tương tự</h3>
                <p onClick={handleClickToHidden}>Ẩn danh sách</p>
            </div>
            <div className="body">
            <Carousel {...settings} arrows >
                {
                    products.map( (product, index) => (
                        <div key={index}>
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
                        </div>
                       
                    ))
                }
            </Carousel>
            </div>
            <div className="products__modalbox">
                <Modal title={`Thông tin sản phẩm #${indexOfSelectedItem}`} visible={isModalVisible} onOk={handleOk} onCancel={handleCancel}>
                    <Modal_ProductDetail product={productSelected} content={indexOfSelectedItem}></Modal_ProductDetail>
                </Modal>
            </div>
        </div>
        }
        </React.Fragment>
       
    );
}

export default ProductsSuggestionCarousel;
