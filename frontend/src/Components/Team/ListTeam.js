import React, { useState } from 'react';
import Table from '@mui/material/Table';
import TableBody from '@mui/material/TableBody';
import TableCell from '@mui/material/TableCell';
import TableContainer from '@mui/material/TableContainer';
import TableHead from '@mui/material/TableHead';
import TableRow from '@mui/material/TableRow';
import Paper from '@mui/material/Paper';
import Box from '@mui/material/Box';
import { TextField } from '@mui/material';

function ListTeam() {

    const [teams, setTeams] = useState([]);
    const [pokemonTypeFilter, setPokemonTypeFilter] = useState([]);

    React.useEffect(() => {
        fetch(process.env.REACT_APP_BACK_END_API + '/team/')
            .then(res => res.json())
            .then(data => setTeams(data.teams));
    }, []);

    return (
        <div style={{
            paddingTop: "50px",
        }}>

            <form style={{ padding: "10px" }}>
                <TextField
                    required
                    onChange={handleChange}
                    id="outlined-required"
                    label="Filter by pokemon type"
                    name="name"
                    value={pokemonTypeFilter}
                />
            </form>

            {
                teams.map((team, index) => {
                    return <div style={{
                        paddingTop: "20px",
                        textAlign: "center",
                        paddingBottom: "50px"
                    }}>
                        <Box
                            sx={{
                                backgroundColor: 'primary.main',
                            }}
                        >
                            <p><b>Team name: {team.name}</b></p>
                            <p><b>Base Experience sum: {team.baseExperienceSum}</b></p>
                        </Box>
                        <TableContainer component={Paper}>
                            <Table sx={{ minWidth: 650 }} aria-label="simple table">
                                <TableHead>
                                    <TableRow>
                                        <TableCell><b>Name</b></TableCell>
                                        <TableCell align="right"><b>Base Experience</b></TableCell>
                                        <TableCell align="right"><b>Image</b></TableCell>
                                        {/* <TableCell align="right">Abilities</TableCell> */}
                                        <TableCell align="right"><b>Types</b></TableCell>
                                    </TableRow>
                                </TableHead>
                                <TableBody>
                                    {team.pokemonList.map((pokemon) => (
                                        <TableRow
                                            key={pokemon.id}
                                            sx={{ '&:last-child td, &:last-child th': { border: 0 } }}
                                        >
                                            <TableCell component="th" scope="row">
                                                {pokemon.name}
                                            </TableCell>
                                            <TableCell align="right">{pokemon.baseExperience}</TableCell>
                                            <TableCell align="right"><img src={pokemon.img} alt='pokemon'></img></TableCell>
                                            {/* <TableCell align="right">{pokemon.abilities}</TableCell> */}
                                            <TableCell align="right">{pokemon.types}</TableCell>
                                        </TableRow>
                                    ))}
                                </TableBody>
                            </Table>
                        </TableContainer>
                    </div>
                })
            };
        </div >
    );
}

export default ListTeam;