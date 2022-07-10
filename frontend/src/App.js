import React, { useState } from "react";
import { BrowserRouter, Outlet, Route, Routes, Link } from "react-router-dom";
import CreateTeam from "./components/team/CreateTeam";
import ListTeam from "./components/team/ListTeam";
import EditTeam from "./components/team/EditTeam";
import Header from "./components/layout/Header";

const navItems = [
    {
        title: "HOME",
        link: "/",
    },
    {
        title: "CREATE TEAM",
        link: "/team/create",
    },
    {
        title: "TEAMS",
        link: "/team/list",
    },
];

function App() {
    return (
        <BrowserRouter>
            <Routes>
                <Route path="/" element={
                    <div>
                        <Header navItems={navItems}/>
                        <div style={{
                            minHeight:"1000px",
                            paddingTop:"50px",
                        }}>
                            <Outlet />
                        </div>
                        {/* <Footer /> */}
                    </div>
                }>
                    <Route path="" element={
                        <div style={{
                            minHeight: "1000px",
                            textAlign: "center",
                            textAnchor: "middle",
                        }}>
                            
                        </div>
                    } />
                    <Route path="team" element={
                        <>
                            <Outlet />
                        </>
                    }>
                        <Route path="list" element={
                            <ListTeam />
                        } />
                        <Route path="create" element={
                            <CreateTeam />
                        } />
                        <Route path=":idTeam/edit" element={
                            <EditTeam />} />
                    </Route>
                </Route>
            </Routes>
        </BrowserRouter>
    );
}

export default App;
