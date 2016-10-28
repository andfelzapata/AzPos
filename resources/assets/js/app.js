require('./bootstrap');

import React from 'react';
import { render } from 'react-dom';
import Dashboard from './components/app/Dashboard.js';

render(<Dashboard/>, document.getElementById('app-container'));

