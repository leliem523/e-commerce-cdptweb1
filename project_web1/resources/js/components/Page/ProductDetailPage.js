import React, { useContext, useEffect, useRef, useState } from 'react';

import '../assets/css/Container.css';
import '../assets/css/ProductDetailPage.css';

import { Row, Col, Layout } from 'antd';
import ProductDetail from '../Components/ProductDetail';
import ProductDescription from '../Components/ProductDescription';
import ProductComment from '../Components/ProductComment';
import { Redirect, useHistory } from 'react-router-dom/cjs/react-router-dom.min';
import LayoutWrapper from '../Components/LayoutWrapper';
import { AuthContext } from '../Contexts/AuthContext';
import { useParams } from 'react-router';
import { useDispatch } from 'react-redux';
import { getProductBySlug } from '../redux/reducers/products';
import ProductsSuggestionCarousel from '../Components/ProductsSuggestionCarousel';

function ProductDetailPage(props) {
  const {slug} = useParams();
  const [isUpdateProduct, setIsUpdateProduct] = useState(false);
  const dispatch = useDispatch();
  const history = useHistory();
  const [isModalVisible, setIsModalVisible] = useState(false);

  const authCtx = useContext(AuthContext); 

  const [product, setProduct] = useState({
    id: -1,
    name: 'Unknown',
    description: 'Unknown',
    image: 'Unknown',
    rating_value: 0.00,
    rating_times: 0,
    price: 0,
    category: 1,
  })

  const payload = {
    token: authCtx.token,
    slug,
  }

 useEffect(() => {
    dispatch(getProductBySlug(payload))
    .then(res => {
      setProduct(res.payload[0]);
      setIsUpdateProduct(false);
      setIsModalVisible(false);
    })
    .catch(() => history.replace("/404"))
 }, [isUpdateProduct || slug])

  const mainContent = () => {
    return (
      <Layout>
        <div className="container">
          <ProductDetail product={product} setIsUpdateProduct={setIsUpdateProduct} />
          <ProductsSuggestionCarousel 
            categoryId={product.category}
            isModalVisible={isModalVisible}
            setIsModalVisible={setIsModalVisible}/>
          <Row gutter={16}>
            <Col className="component-layout" xs={24} lg={12}>
              <ProductDescription product={product} />
            </Col>
            <Col className="component-layout" xs={24} lg={12}>
              <ProductComment product={product} />
            </Col>
          </Row>
        </ div>
      </Layout>
    );
  }

  return (
    <React.Fragment>
      {
        product ? (

          <LayoutWrapper mainContent={mainContent}></LayoutWrapper>

        ) : <Redirect to="/home" />
      }
    </React.Fragment>
  );
}

export default ProductDetailPage;