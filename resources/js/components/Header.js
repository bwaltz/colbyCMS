import React from 'react';
import { Link } from 'react-router-dom';

const Header = () => (
    <nav
        className="navbar navbar-dark fixed-top flex-md-nowrap p-0 shadow"
        style={{ backgroundColor: '#313131' }}
    >
        <Link
            className="navbar-brand col-sm-3 col-md-2 mr-0"
            to="/admin/dashboard"
        >
            ColbyCMS
        </Link>
        <input
            className="form-control form-control-dark w-100"
            type="text"
            placeholder="Search"
            aria-label="Search"
        />
        <ul className="navbar-nav px-3">
            <li className="nav-item text-nowrap">
                <a className="nav-link" href="/admin/logout">
                    Sign out
                </a>
            </li>
        </ul>
    </nav>
);

export default Header;
