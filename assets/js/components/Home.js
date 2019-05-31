import React, { Component} from 'react';
import NavBar from '../components/NavBar';
import { Route, Switch, Link, withRouter } from 'react-router-dom';

import auth0Client from '../utils/Auth';

class Home extends Component {
    render(){
        return (
            <div>
                <NavBar/>
            </div>
        )
    };

}

export default withRouter(Home);