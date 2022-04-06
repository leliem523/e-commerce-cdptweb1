import React, { useContext, useEffect, useState } from 'react';
import { Link, useHistory } from 'react-router-dom';
import { Input, Menu, Dropdown, Avatar, Badge } from 'antd';
import { DownOutlined, UserOutlined, ShoppingCartOutlined, SearchOutlined } from '@ant-design/icons';

// Components:
import SearchBox from '../SearchBox';
import LocationBox from '../LocationBox';
import LogOut from '../../Components/LogOut/LogOut';
import { logo } from '../../Services/images.service';

// Context:
import { AuthContext } from '../../Contexts/AuthContext';

// Redux:
import { useDispatch, useSelector } from 'react-redux';

// CSS:
import '../../assets/css/HeaderLayout.css';


const HeaderLayout = (props) => {
  // Context:
  const authCtx = useContext(AuthContext);

  // State:
  const [username, setUsername] = useState('Unknown')

  // Redux:
  const dispatch = useDispatch();

  // Routing:
  const history = useHistory();

  const onSearch = key => {
    key = key.replace(/^\s+|\s+$/g, "");
    if (key && key.trim().length > 0) {
      history.replace(`/search?key=${key}`);
    }
  };

  const handleUpdateInfoClick = () => {
    history.replace('/update-information');
  }

  const menu = () => {
    if (authCtx.isLoggedIn === true) {
      return (
        <Menu>
            <Menu.Item key="btn-updateUserInfo">
              <div className="user-update" onClick={handleUpdateInfoClick}>Information Changing</div>
          </Menu.Item>
          <Menu.Item key="btn-logout">
            <LogOut />
          </Menu.Item>
        </Menu>
      );
    }
    else {
      return (
        <Menu>
          <Menu.Item key="btn-login">
            <Link to="/login">
              Login
            </Link>
          </Menu.Item>
          <Menu.Item key="btn-register">
            <Link to="/register">
              Register
            </Link>
          </Menu.Item>
        </Menu>
      );
    }
  }

  useEffect(() => {
    if (authCtx.isLoggedIn) {
      if (typeof authCtx.data !== "undefined" && authCtx.data !== null) {
        const getName = authCtx.data.name.split(' ')[authCtx.data.name.split(' ').length - 1];
        setUsername(getName);
      }
      else {
        setUsername('Unknown');
      }
    }
  })

  return (
    <div className="header">
      <div className="container">
        <div className="header-wrapper">
          <div className="header__left-section">
            <Link to="/" className="logo-wrapper">
              <img className="logo" src={logo}></img>
            </Link>
          </div>
          <div className="header__controls-section">
            <label
              className="bars-btn"
              htmlFor=""
              onClick={() => { return props.setIsChecked(!props.isChecked); }}
            >
              <div className="hamburger-btn">
                <div className="bar"></div>
              </div>
            </label>

            <LocationBox></LocationBox>

            <SearchBox onSearch={onSearch}></SearchBox>

            <label className="search-btn-wrapper" htmlFor="checkbox-for-MegaMenu">
              <div className="search-btn">
                <SearchOutlined />
                <input type="checkbox" name="" id="checkbox-for-MegaMenu"></input>
                <label className="overlay" htmlFor="checkbox-for-MegaMenu"></label>
                <div className="mega-menu">
                  <SearchBox onSearch={onSearch}></SearchBox>
                </div>
              </div>
            </label>
          </div>
          <div className="header__right-section">
            <Link className="cart-btn" to="/shopping-cart">
              <ShoppingCartOutlined className="cart-icon" />
              <span className="cart-btn__title">Shopping cart</span>
            </Link>
            <Dropdown overlay={menu} arrow placement="bottomRight">
              <div className="account-btn">
                <Avatar className="avt" size="small" icon={<UserOutlined />} className="user-icon" />
                <span className="account-btn__title">{authCtx.isLoggedIn ? username : 'Account'}</span>
                <DownOutlined />
              </div>
            </Dropdown>
          </div>
        </div>
      </div>
    </div>

  );
}

export default HeaderLayout;