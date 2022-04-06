import React, { useContext, useEffect } from 'react'
import '../assets/css/Navigation.css'
import { Menu } from 'antd';
import { MenuFoldOutlined } from '@ant-design/icons';
import { AuthContext } from '../Contexts/AuthContext';
import { useDispatch, useSelector } from 'react-redux';
import { getCategories } from '../redux/reducers/categories';
import { useHistory } from 'react-router-dom';

const { SubMenu } = Menu;

// submenu keys of first level
const rootSubmenuKeys = ['sub1', 'sub2', 'sub3'];


function Navigation(props) {
  const [openKeys, setOpenKeys] = React.useState(['sub1']);

  const authCtx = useContext(AuthContext);
  const { categories } = useSelector(state => state.categories)
  const dispatch = useDispatch();

  const history = useHistory();

  useEffect(() => {
    dispatch(getCategories(authCtx.token))
  }, [])


  const handleMenuClick = (e) => {
    if (e.key == 0) {
      props.setIsChecked(!props.isChecked);
      history.push(`/category/${btoa('111'.concat('all'))}`);
    }
    else {
      props.setIsChecked(!props.isChecked);
      history.push(`/category/${btoa('111'.concat(e.key))}`);
    }
  }

  const onOpenChange = keys => {

    const latestOpenKey = keys.find(key => openKeys.indexOf(key) === -1);
    if (rootSubmenuKeys.indexOf(latestOpenKey) === -1) {
      setOpenKeys(keys);
    } else {
      setOpenKeys(latestOpenKey ? [latestOpenKey] : []);
    }
  };
  return (
    <div className="nav" style={{ width: '100%' }}>
      <h1 className="nav-title">
        <nav className="title">Product categories </nav>
        <MenuFoldOutlined className="nav-icon" />
        <div className="close-btn" onClick={() => { return props.setIsChecked(!props.isChecked); }}>X</div>
      </h1>
      <Menu
        mode="inline"
        theme="light"
        onOpenChange={onOpenChange}
        openKeys={openKeys}
      >
        <SubMenu key={0} title="Tất cả" onTitleClick={handleMenuClick} />
        {
          categories.map(cate => {
            return (
              <SubMenu key={cate.id} title={cate.name} onTitleClick={handleMenuClick} />
            )
          })
        }
      </Menu>
    </div>
  )
}

export default Navigation