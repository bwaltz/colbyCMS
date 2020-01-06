import React from "react";
import { Link, withRouter } from "react-router-dom";
import _findIndex from "lodash/findIndex";
const ColbyCMS = window.colbyCMS;

const Menu = props => (
    <nav className="col-md-2 d-none d-md-block bg-light sidebar">
        <div className="sidebar-sticky">
            <ul className="nav flex-column">
                <li className="nav-item">
                    <Link
                        className={`nav-link ${
                            props.location.pathname === "/admin/dashboard"
                                ? "active"
                                : ""
                        }`}
                        to="/admin/dashboard"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            strokeWidth="2"
                            strokeLinecap="round"
                            strokeLinejoin="round"
                            className="feather feather-home"
                        >
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        Dashboard <span className="sr-only">(current)</span>
                    </Link>
                </li>

                {_findIndex(
                    ColbyCMS.currentUser.permissions,
                    o => o.name === "admin.view.posts"
                ) >= 0 && (
                    <li className="nav-item">
                        <Link
                            className={`nav-link ${
                                props.location.pathname === "/admin/posts"
                                    ? "active"
                                    : ""
                            }`}
                            to="/admin/posts"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                strokeWidth="2"
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                className="feather feather-edit"
                            >
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                            Posts
                        </Link>
                    </li>
                )}
                {_findIndex(
                    ColbyCMS.currentUser.permissions,
                    o => o.name === "admin.view.pages"
                ) >= 0 && (
                    <li className="nav-item">
                        <Link
                            className={`nav-link ${
                                props.location.pathname === "/admin/pages"
                                    ? "active"
                                    : ""
                            }`}
                            to="/admin/pages"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                strokeWidth="2"
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                className="feather feather-file"
                            >
                                <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                <polyline points="13 2 13 9 20 9"></polyline>
                            </svg>
                            Pages
                        </Link>
                    </li>
                )}
                {_findIndex(
                    ColbyCMS.currentUser.permissions,
                    o => o.name === "admin.view.taxonomy"
                ) >= 0 && (
                    <li className="nav-item">
                        <Link
                            className={`nav-link ${
                                props.location.pathname === "/admin/categories"
                                    ? "active"
                                    : ""
                            }`}
                            to="/admin/categories"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                strokeWidth="2"
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                className="feather feather-tag"
                            >
                                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                <line x1="7" y1="7" x2="7.01" y2="7"></line>
                            </svg>
                            Taxonomy
                        </Link>
                    </li>
                )}

                {_findIndex(
                    ColbyCMS.currentUser.permissions,
                    o => o.name === "admin.view.media"
                ) >= 0 && (
                    <li className="nav-item">
                        <Link
                            className={`nav-link ${
                                props.location.pathname ===
                                "/admin/media-library"
                                    ? "active"
                                    : ""
                            }`}
                            to="/admin/media-library"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                strokeWidth="2"
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                className="feather feather-image"
                            >
                                <rect
                                    x="3"
                                    y="3"
                                    width="18"
                                    height="18"
                                    rx="2"
                                    ry="2"
                                ></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                            Media Library
                        </Link>
                    </li>
                )}
                {_findIndex(
                    ColbyCMS.currentUser.permissions,
                    o => o.name === "admin.view.settings"
                ) >= 0 && (
                    <li className="nav-item">
                        <Link
                            className={`nav-link ${
                                props.location.pathname === "/admin/settings"
                                    ? "active"
                                    : ""
                            }`}
                            to="/admin/settings"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                strokeWidth="2"
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                className="feather feather-sliders"
                            >
                                <line x1="4" y1="21" x2="4" y2="14"></line>
                                <line x1="4" y1="10" x2="4" y2="3"></line>
                                <line x1="12" y1="21" x2="12" y2="12"></line>
                                <line x1="12" y1="8" x2="12" y2="3"></line>
                                <line x1="20" y1="21" x2="20" y2="16"></line>
                                <line x1="20" y1="12" x2="20" y2="3"></line>
                                <line x1="1" y1="14" x2="7" y2="14"></line>
                                <line x1="9" y1="8" x2="15" y2="8"></line>
                                <line x1="17" y1="16" x2="23" y2="16"></line>
                            </svg>
                            Settings
                        </Link>
                    </li>
                )}
                {_findIndex(
                    ColbyCMS.currentUser.permissions,
                    o => o.name === "admin.view.users"
                ) >= 0 && (
                    <li className="nav-item">
                        <a className="nav-link" href="#">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                strokeWidth="2"
                                strokeLinecap="round"
                                strokeLinejoin="round"
                                className="feather feather-users"
                            >
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            Users
                        </a>
                    </li>
                )}
            </ul>
        </div>
    </nav>
);

export default withRouter(Menu);
